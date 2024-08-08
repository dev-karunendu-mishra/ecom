<x-form-component
    :fields="$fields"
    :isEditing="$edit"
    actionRoute="{{route('admin.categories.store')}}"
    editRoute="{{ $edit ? route('admin.categories.update', $model->id) : ''}}"
    isSEOEnabled="{{true}}"
    :model="$model"
    updateBtnText="Update Information"
    submitBtnText="Create New Category" />

    