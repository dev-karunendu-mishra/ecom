<x-form-component :fields="$fields" :isEditing="$edit" actionRoute="{{route('admin.pages.store')}}"
    editRoute="{{ $edit ? route('admin.pages.update', $model->id) : ''}}" isSEOEnabled="{{true}}" :model="$model"
    updateBtnText="Update Information" submitBtnText="Create New Page" />

