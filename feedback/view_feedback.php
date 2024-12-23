<?php
session_start();
require_once '../Account/conn.php';

if (!isset($_SESSION['doctor_id'])) {
    header("Location: ../Account/login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

// Fetch feedback for this doctor
$sql = "SELECT pf.*, p.full_name as patient_name, d.Fname as doctor_fname, d.Lname as doctor_lname 
        FROM patient_feedback pf 
        JOIN patient p ON pf.patient_id = p.patient_id 
        JOIN doctors d ON pf.doctor_id = d.id 
        WHERE pf.doctor_id = ?
        ORDER BY pf.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Feedback</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: 'rgba(15, 151, 155, 0.804)',
                        secondary: '#E0F2FE',
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/services.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="components/css/profile.css">

    <style>
        .feedback-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen bg-gradient-to-b from-primary to-white">
    <!-- Include Header -->
    <?php require_once '../components/header.php'; ?>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 mt-[10%]">
        <div class="bg-white p-16 rounded-lg shadow-lg max-w-6xl mx-auto">
            <h1 class="text-5xl font-bold text-center text-primary mb-12">Patient Feedback Overview</h1>
            
            <!-- Overall Rating Summary -->
            <div class="bg-gray-50 p-8 rounded-xl mb-12">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6">Overall Rating</h2>
                <div class="flex items-center justify-center space-x-4">
                    <?php
                    // Calculate average rating
                    $total_rating = 0;
                    $count = 0;
                    $ratings = [];
                    while ($row = $result->fetch_assoc()) {
                        $total_rating += $row['rating'];
                        $count++;
                        $ratings[] = $row;
                    }
                    $avg_rating = $count > 0 ? round($total_rating / $count, 1) : 0;
                    ?>
                    <div class="text-6xl font-bold text-primary"><?php echo $avg_rating; ?></div>
                    <div class="flex text-4xl text-yellow-400">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $avg_rating) {
                                echo '<span class="text-yellow-400">★</span>';
                            } else {
                                echo '<span class="text-gray-300">★</span>';
                            }
                        }
                        ?>
                    </div>
                    <div class="text-2xl text-gray-600">(<?php echo $count; ?> reviews)</div>
                </div>
            </div>

            <!-- Feedback Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php foreach ($ratings as $feedback): ?>
                    <div class="feedback-card bg-white p-8 rounded-xl shadow-md transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-2xl font-semibold text-gray-800">
                                    <?php echo htmlspecialchars($feedback['patient_name']); ?>
                                </h3>
                                <p class="text-xl text-gray-500">
                                    <?php echo date('F j, Y', strtotime($feedback['created_at'])); ?>
                                </p>
                            </div>
                            <div class="flex text-2xl">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $feedback['rating']) {
                                        echo '<span class="text-yellow-400">★</span>';
                                    } else {
                                        echo '<span class="text-gray-300">★</span>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <p class="text-xl text-gray-700 leading-relaxed">
                            <?php echo htmlspecialchars($feedback['feedback']); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php require_once '../components/footer.php'; ?>

    <!-- Back to Top Button -->
    <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
        <ion-icon name="chevron-up"></ion-icon>
    </a>

    <!-- Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>