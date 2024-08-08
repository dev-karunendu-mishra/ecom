<x-form-component
    :fields="$fields"
    :isEditing="$edit"
    actionRoute="{{route('admin.blogs.store')}}"
    editRoute="{{ $edit ? route('admin.blogs.update', $model->id) : ''}}"
    isSEOEnabled="{{true}}"
    :model="$model"
    updateBtnText="Update Information"
    submitBtnText="Create New Blog" />

    