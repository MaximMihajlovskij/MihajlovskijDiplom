<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfController extends Controller
{
/**
     * Обновление данных профиля.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // ✅ Валидируем данные
        $validated = $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'address' => ['string', 'max:255'],
            'telephon' => ['phone:BY'],
            'avatar' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // ✅ Обновляем текстовые поля
        $user->fill($validated);

        // ✅ Обновляем аватар
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar); // Удаляем старый аватар
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // ✅ Если email изменился, сбрасываем подтверждение
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->back()->with('success', 'Профиль успешно обновлён!');
    }

    /**
     * Удаление аватара.
     */
    public function deleteAvatar()
    {
        $user = Auth::user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar); // Удаляем старый аватар
        }

        // Заменяем аватар на стандартное изображение
        $user->avatar = 'banners/аватарка.jpg';
        $user->save();

        return response()->json(['success' => true, 'newAvatar' => asset('storage/banners/аватарка.jpg')]);
    }

    /**
     * Выход из аккаунта.
     */
    public function logout()
    {
        Auth::logout();
        return redirect('index')->with('success', 'Вы вышли из аккаунта!');
    }

    public function deleteAccount()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Пользователь не найден!'], 404);
        }

        // Удаляем аватар, если есть
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Удаляем аккаунт
        $user->delete();

        // Разлогиниваем пользователя
        Auth::logout();

        return redirect('index')->with('success', 'Вы удалили аккаунт!');
    }
}
