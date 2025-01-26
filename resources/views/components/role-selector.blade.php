<select name="{{ $name }}" class="form-control custom-select @error($name) is-invalid @enderror" required>
    <option value='null'>Select a role</option>
    @foreach ($roles as $key => $value)
        <option value="{{ $key }}" @selected($key === $role)>
            {{ __($value) }}
        </option>
    @endforeach
</select>
