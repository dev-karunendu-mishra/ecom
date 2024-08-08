<x-form-component :fields="$fields" :isEditing="$edit" actionRoute="{{route('admin.clients.store')}}"
    editRoute="{{ $edit ? route('admin.clients.update', $model->id) : ''}}" isSEOEnabled="{{false}}" :model="$model"
    updateBtnText="Update Information" submitBtnText="Create New Client" />