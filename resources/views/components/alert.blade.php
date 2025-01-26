<div {{ $attributes->merge(['class' => 'alert alert-' . $type, 'role' => 'alert']) }}>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      @isset($icon)
          <i class="{{  'mr-1 '. $icon }}" aria-hidden="true"></i>
      @endisset
      {{ $slot }}
  </div>
  
    