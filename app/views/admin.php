<?php
require_once 'config/connect_DB.php';

class Dat
{
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }

    public function query($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }
        return $result;
    }

    public function fetchAll($result)
    {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function closeResult($result)
    {
        mysqli_free_result($result);
    }
}

class AdminDashboard
{
    private $db;

    public function __construct(Dat $db)
    {
        $this->db = $db;
    }

    public function getUserData()
    {
        $sql = 'SELECT username, id, created_at, description FROM users ORDER BY created_at DESC';
        $result = $this->db->query($sql);
        $userData = $this->db->fetchAll($result);
        $this->db->closeResult($result);
        return $userData;
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);
        $users = $this->db->fetchAll($result);
        $this->db->closeResult($result);
        return $users;
    }

    public function getNoteCount()
    {
        $sql = "SELECT COUNT(*) AS row_count FROM topics";
        $result = $this->db->query($sql);
        $row = $this->db->fetchAll($result)[0];
        $this->db->closeResult($result);
        return $row['row_count'];
    }

    public function getTodayNoteCount()
    {
        $today = date('Y-m-d');
        $sql = "SELECT COUNT(*) AS today_count FROM topics WHERE DATE(date) = '$today'";
        $result = $this->db->query($sql);
        $row = $this->db->fetchAll($result)[0];
        $this->db->closeResult($result);
        return $row['today_count'];
    }

    public function getNotesPerDay($startDate, $endDate)
    {
        $sql = "SELECT DATE(date) as day, COUNT(*) as count FROM topics WHERE date BETWEEN '$startDate' AND '$endDate' GROUP BY DATE(date)";
        $result = $this->db->query($sql);
        $notesPerDay = $this->db->fetchAll($result);
        $this->db->closeResult($result);
        return $notesPerDay;
    }

    public function getNoteStatusDistribution()
    {
        $sql = "SELECT status, COUNT(*) as count FROM topics GROUP BY status";
        $result = $this->db->query($sql);
        $statusDistribution = $this->db->fetchAll($result);
        $this->db->closeResult($result);
        return $statusDistribution;
    }
}

$db = new Dat();
$adminDashboard = new AdminDashboard($db);

$userData = $adminDashboard->getUserData();
$users = $adminDashboard->getAllUsers();
$noteCount = $adminDashboard->getNoteCount();
$todayNoteCount = $adminDashboard->getTodayNoteCount();
$notesPerDay = $adminDashboard->getNotesPerDay('2024-12-01', '2024-12-22');

$notesPerDayJson = json_encode($notesPerDay);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinical Note Analysis - Admin Dashboard</title>
    <link rel="stylesheet" href="http://localhost/project/public/assets/css/admin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>ClinicalNotes</h2>
            </div>
            <ul class="nav-links">
                <li><a href="index.php?url=home/index"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="index.php?url=discussions/index"><i class="fas fa-comments"></i> Discussions</a></li>
                <li><a href="index.php?url=userManagement/index"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="index.php?url=analytics/index"><i class="fas fa-chart-line"></i> Analytics</a></li>
                <li><a href="index.php?url=login/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>

        <main class="main-content">
            <header class="main-header">
                <h1>Dashboard Overview</h1>
            </header>

            <section class="dashboard-stats">
                <div class="stat-card">
                    <h3>Total Discussion</h3>
                    <p><?php echo isset($noteCount) ? number_format($noteCount) : 0; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Users</h3>
                    <p><?php echo isset($userData) ? number_format(count($userData)) : 0; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Notes Analyzed Today</h3>
                    <p><?php echo isset($todayNoteCount) ? number_format($todayNoteCount) : 0; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Pending Notes</h3>
                    <p>34</p>
                </div>
            </section>

            <section class="charts-section">
                <div class="chart">
                    <h3>Note Status Distribution</h3>
                    <canvas id="statusChart" height="300"></canvas>
                </div>
            </section>

            <section class="notes-section">
                <h3>Recent Clinical Notes</h3>
                <table class="notes-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>User ID</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 0; ?>
                        <?php foreach ($userData as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td>
                                    <?php 
                                        $status = htmlspecialchars($user['description']);
                                        $statusClass = '';
                                        switch(strtolower($status)) {
                                            case 'completed':
                                                $statusClass = 'status-completed';
                                                break;
                                            case 'pending':
                                                $statusClass = 'status-pending';
                                                break;
                                            default:
                                                $statusClass = 'status-progress';
                                        }
                                    ?>
                                    <span class="status-badge <?php echo $statusClass; ?>"><?php echo $status; ?></span>
                                </td>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                            </tr>
                            <?php $counter++; ?>
                            <?php if ($counter == 5) break; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    Chart.defaults.font.family = "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif";
    Chart.defaults.font.size = 12;
    Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(0, 0, 0, 0.8)';
    
    const activityChartData = {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_map(function($day) {
                return date('M d', strtotime($day['day']));
            }, $notesPerDay)); ?>,
            datasets: [{
                label: 'Notes Created',
                data: <?php echo json_encode(array_map(function($day) {
                    return $day['count'];
                }, $notesPerDay)); ?>,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#2563eb',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    padding: 10,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    titleFont: {
                        size: 13,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    },
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        padding: 10,
                        color: '#6b7280'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        padding: 10,
                        color: '#6b7280'
                    }
                }
            }
        }
    };

    const statusDistribution = <?php 
        $distribution = $adminDashboard->getNoteStatusDistribution();
        echo json_encode(array_map(function($status) {
            return [
                'label' => $status['status'],
                'count' => $status['count']
            ];
        }, $distribution));
    ?>;

    const statusChartData = {
        type: 'doughnut',
        data: {
            labels: statusDistribution.map(item => item.label),
            datasets: [{
                data: statusDistribution.map(item => item.count),
                backgroundColor: [
                    '#10b981',
                    '#f59e0b',
                    '#2563eb'
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    padding: 10,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    titleFont: {
                        size: 13,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    },
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    };

    try {
        const activityCtx = document.getElementById('activityChart').getContext('2d');
        new Chart(activityCtx, activityChartData);

        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, statusChartData);
    } catch (error) {
        console.error('Error initializing charts:', error);
    }
});
</script>
</body>
</html>