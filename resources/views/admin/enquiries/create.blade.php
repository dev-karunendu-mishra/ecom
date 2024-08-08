<x-form-component :fields="$fields" :isEditing="$edit" actionRoute="{{route('admin.enquiries.store')}}"
    editRoute="{{ $edit ? route('admin.enquiries.update', $model->id) : ''}}" isSEOEnabled="{{false}}" :model="$model"
    updateBtnText="Update Information" submitBtnText="Create New Enquiry" />