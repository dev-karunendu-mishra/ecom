<x-form-component
    :fields="$fields"
    :isEditing="$edit"
    actionRoute="{{route('admin.products.store')}}"
    editRoute="{{ $edit ? route('admin.products.update', $model->id) : ''}}"
    isSEOEnabled="{{true}}"
    :model="$model"
    updateBtnText="Update Information"
    submitBtnText="Create New Product" />

    