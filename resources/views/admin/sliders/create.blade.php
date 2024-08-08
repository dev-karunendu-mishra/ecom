<x-form-component :fields="$fields" :isEditing="$edit" actionRoute="{{route('admin.sliders.store')}}"
    editRoute="{{ $edit ? route('admin.sliders.update', $model->id) : ''}}" isSEOEnabled="{{false}}" :model="$model"
    updateBtnText="Update Information" submitBtnText="Create New Slider" />