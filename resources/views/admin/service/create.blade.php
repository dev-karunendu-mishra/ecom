<x-form-component
    :fields="$fields"
    :isEditing="$edit"
    actionRoute="{{route('admin.services.store')}}"
    editRoute="{{ $edit ? route('admin.services.update', $model->id) : ''}}"
    isSEOEnabled="{{true}}"
    :model="$model"
    updateBtnText="Update Information"
    submitBtnText="Create New Service" />

    