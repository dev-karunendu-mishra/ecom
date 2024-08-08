<x-form-component
    :fields="$fields"
    :isEditing="$edit"
    actionRoute="{{route('admin.packages.store')}}"
    editRoute="{{ $edit ? route('admin.packages.update', $model->id) : ''}}"
    isSEOEnabled="{{true}}"
    :model="$model"
    updateBtnText="Update Information"
    submitBtnText="Create New Package" />

    