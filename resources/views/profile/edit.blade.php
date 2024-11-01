<form method="POST" action="{{ url('/profile') }}">
    @csrf
    <label for="name">Név:</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    
    <button type="submit">Profil frissítése</button>
</form>

