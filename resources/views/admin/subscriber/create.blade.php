<x-form-component
    :fields="$fields"
    :isEditing="$edit"
    actionRoute="{{route('admin.subscribers.store')}}"
    editRoute="{{ $edit ? route('admin.subscribers.update', $model->id) : ''}}"
    isSEOEnabled="{{false}}"
    :model="$model"
    updateBtnText="Update Information"
    submitBtnText="Create New Subscriber" />

    