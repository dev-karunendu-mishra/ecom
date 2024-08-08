<x-form-component
    :fields="$fields"
    :isEditing="$edit"
    actionRoute="{{route('admin.blog-categories.store')}}"
    editRoute="{{ $edit ? route('admin.blog-categories.update', $model->id) : ''}}"
    isSEOEnabled="{{false}}"
    :model="$model"
    updateBtnText="Update Information"
    submitBtnText="Create New Blog Category" />

    