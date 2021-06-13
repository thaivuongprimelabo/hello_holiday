<div class="card-header">
    <h3 class="card-title">
        @include('cms::auth.components.form.button_back', [
            'route' => $route
        ])
    </h3>
    <div class="card-tools">
        @include('cms::auth.components.form.button', [
            'type' => 'submit',
            'icon' => 'fas fa-save',
            'label' => 'Lưu'
        ])
    </div>
</div>