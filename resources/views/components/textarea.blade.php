<div class="mb-3">
  @if($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
  @endif
  <textarea 
    name="{{ $name }}" 
    id="{{ $name }}" 
    class="textarea w-full border-gray-300 rounded-md" 
    rows="4"
  >{{ old($name, $value) }}</textarea>
</div>