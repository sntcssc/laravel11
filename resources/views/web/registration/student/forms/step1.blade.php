<div class="form-group">
    <label for="unique_id">Unique ID</label>
    <input type="text" name="unique_id" id="unique_id" class="form-control @error('unique_id') is-invalid @enderror" value="{{ old('unique_id') }}">
    @error('unique_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
    @error('first_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
    @error('last_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="father_name">Father's Name</label>
    <input type="text" name="father_name" id="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name') }}">
    @error('father_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="father_occupation">Father's Occupation</label>
    <input type="text" name="father_occupation" id="father_occupation" class="form-control @error('father_occupation') is-invalid @enderror" value="{{ old('father_occupation') }}">
    @error('father_occupation')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="mother_name">Mother's Name</label>
    <input type="text" name="mother_name" id="mother_name" class="form-control @error('mother_name') is-invalid @enderror" value="{{ old('mother_name') }}">
    @error('mother_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="mother_occupation">Mother's Occupation</label>
    <input type="text" name="mother_occupation" id="mother_occupation" class="form-control @error('mother_occupation') is-invalid @enderror" value="{{ old('mother_occupation') }}">
    @error('mother_occupation')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="dob">Date of Birth</label>
    <input type="date" name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
    @error('dob')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="gender">Gender</label>
    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
        <option value="">Select Gender</option>
        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
    </select>
    @error('gender')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="category">Category</label>
    <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}">
    @error('category')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="mobile_number">Mobile Number</label>
    <input type="text" name="mobile_number" id="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number') }}">
    @error('mobile_number')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="whatsapp_number">WhatsApp Number</label>
    <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control @error('whatsapp_number') is-invalid @enderror" value="{{ old('whatsapp_number') }}">
    @error('whatsapp_number')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="password_confirmation">password_confirmation</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}">
    @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="present_state">Present State</label>
    <input type="text" name="present_state" id="present_state" class="form-control @error('present_state') is-invalid @enderror" value="{{ old('present_state') }}">
    @error('present_state')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="present_district">Present District</label>
    <input type="text" name="present_district" id="present_district" class="form-control @error('present_district') is-invalid @enderror" value="{{ old('present_district') }}">
    @error('present_district')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="present_address">Present Address</label>
    <textarea name="present_address" id="present_address" class="form-control @error('present_address') is-invalid @enderror">{{ old('present_address') }}</textarea>
    @error('present_address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="present_pin">Present Pin</label>
    <input type="text" name="present_pin" id="present_pin" class="form-control @error('present_pin') is-invalid @enderror" value="{{ old('present_pin') }}">
    @error('present_pin')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="permanent_state">Permanent State</label>
    <input type="text" name="permanent_state" id="permanent_state" class="form-control @error('permanent_state') is-invalid @enderror" value="{{ old('permanent_state') }}">
    @error('permanent_state')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="permanent_district">Permanent District</label>
    <input type="text" name="permanent_district" id="permanent_district" class="form-control @error('permanent_district') is-invalid @enderror" value="{{ old('permanent_district') }}">
    @error('permanent_district')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="permanent_address">Permanent Address</label>
    <textarea name="permanent_address" id="permanent_address" class="form-control @error('permanent_address') is-invalid @enderror">{{ old('permanent_address') }}</textarea>
    @error('permanent_address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="permanent_pin">Permanent Pin</label>
    <input type="text" name="permanent_pin" id="permanent_pin" class="form-control @error('permanent_pin') is-invalid @enderror" value="{{ old('permanent_pin') }}">
    @error('permanent_pin')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror">
    @error('photo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="is_update">Is Update</label>
    <select name="is_update" id="is_update" class="form-control @error('is_update') is-invalid @enderror">
        <option value="yes" {{ old('is_update') == 'yes' ? 'selected' : '' }}>Yes</option>
        <option value="no" {{ old('is_update') == 'no' ? 'selected' : '' }}>No</option>
    </select>
    @error('is_update')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="login">Login</label>
    <select name="login" id="login" class="form-control @error('login') is-invalid @enderror">
        <option value="1" {{ old('login') == '1' ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ old('login') == '0' ? 'selected' : '' }}>No</option>
    </select>
    @error('login')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>