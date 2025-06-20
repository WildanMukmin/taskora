<?php
$title_page = 'Upcoming Deadline';
require_once __DIR__ . '/../../includes/gate_user.php'; 
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="flex-grow p-4 md:p-6 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Upcoming Deadlines</h2>

            <div class="space-y-4">
                <?php
                $today = date('Y-m-d');

                foreach ($tasks as $task):
                    $due = $task['due_date'];
                    $status = $task['status'];

                    // Tampilkan hanya tugas yang masih dalam progress dan due date >= hari ini
                    if ($status === 'progress' && $due >= $today):
                        $daysLeft = (strtotime($due) - strtotime($today)) / (60 * 60 * 24);
                        $badgeClass = match (true) {
                            $daysLeft <= 2 => 'bg-red-100 text-red-800',
                            $daysLeft <= 5 => 'bg-yellow-100 text-yellow-800',
                            default => 'bg-green-100 text-green-800',
                        };
                ?>
                <div class="p-5 rounded-xl border border-gray-100 hover:border-indigo-200 hover:bg-indigo-50/40 transition group bg-white shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600 transition">
                                <?= htmlspecialchars($task['title']) ?>
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                                <?= htmlspecialchars($task['description']) ?>
                            </p>
                        </div>
                        <span class="text-xs font-medium px-3 py-1 rounded-full <?= $badgeClass ?> self-start">
                            <?= $daysLeft ?> day<?= $daysLeft != 1 ? 's' : '' ?> left
                        </span>
                    </div>
                    <div class="mt-3 flex items-center text-xs text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <?= date('M d, Y', strtotime($due)) ?>
                    </div>
                </div>
                <?php endif; endforeach; ?>

                <?php if (!array_filter($tasks, fn($t) => $t['status'] === 'progress' && $t['due_date'] >= $today)): ?>
                <p class="text-sm text-gray-500 text-center italic">No upcoming deadlines.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
