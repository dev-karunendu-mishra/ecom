<x-form-component
    :fields="$fields"
    :isEditing="$edit"
    actionRoute="{{route('admin.brands.store')}}"
    editRoute="{{ $edit ? route('admin.brands.update', $model->id) : ''}}"
    isSEOEnabled="{{true}}"
    :model="$model"
    updateBtnText="Update Information"
    submitBtnText="Create New Brand" />