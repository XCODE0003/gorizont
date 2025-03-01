// ... existing code ...

// Неправильно:
if ($user->last_spin === null || $user->last_spin->diffInHours(now()) > 24) {
    $user->free_spins += 2;
    $user->save();
}

// Правильно:
if ($user->last_spin === null || now()->diffInHours(\Carbon\Carbon::parse($user->last_spin)) > 24) {
    $user->free_spins += 2;
    $user->save();
}
// ... existing code ...