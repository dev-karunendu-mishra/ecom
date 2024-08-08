<x-form-component
    :fields="$fields"
    :isEditing="$edit"
    actionRoute="{{route('admin.testimonials.store')}}"
    editRoute="{{ $edit ? route('admin.testimonials.update', $model->id) : ''}}"
    isSEOEnabled="{{false}}"
    :model="$model"
    updateBtnText="Update Information"
    submitBtnText="Create New Testimonial" />

    