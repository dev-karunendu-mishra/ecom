<x-form-component
    :fields="$fields"
    :isEditing="$edit"
    actionRoute="{{route('admin.industries.store')}}"
    editRoute="{{ $edit ? route('admin.industries.update', $model->id) : ''}}"
    isSEOEnabled="{{true}}"
    :model="$model"
    updateBtnText="Update Information"
    submitBtnText="Create New Industry" />

    