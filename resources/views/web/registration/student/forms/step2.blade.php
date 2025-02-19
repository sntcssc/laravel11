<div class="mb-3">
    <label for="dob" class="form-label">Date of Birth</label>
    <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}" required>
</div>

<div class="mb-3">
    <label for="gender" class="form-label">Gender</label>
    <select name="gender" id="gender" class="form-select" required>
        <option value="" disabled selected>Select Gender</option>
        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
    </select>
</div>
