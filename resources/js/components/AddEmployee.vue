<template>
  <div class="py-3 justify-content-center flex-column align-items-center">
    <form @submit.prevent="addEmployee()">
      <div class="container w-25">
        <div class="col py-3">
          <label for="fullName">Employee Full Name</label>
          <input type="text" id="fullName" v-model="name" class="form-control" :class="{'is-invalid': errors.full_name.length}">
          <div class="invalid-feedback" v-for="(error, index) in errors.full_name" :key="index">
            {{ error }}
          </div>
        </div>
        <div class="col py-3">
          <label for="contact">Contact Number</label>
          <input type="text" id="contact" v-model="contact_number" class="form-control" :class="{'is-invalid': errors.contact_number.length}">
          <div class="invalid-feedback" v-for="(error, index) in errors.contact_number" :key="index">
            {{ error }}
          </div>
        </div>
        <div class="col py-3">
          <label for="email">Email</label>
          <input type="email" id="email" v-model="email" class="form-control" :class="{'is-invalid': errors.email.length}">
          <div class="invalid-feedback" v-for="(error, index) in errors.email" :key="index">
            {{ error }}
          </div>
        </div>
        <div class="col py-3">
          <label for="departmentName">Department</label>
          <select name="department" class="form-select" v-model="department_id">
            <option v-for="department in departments.data" v-bind:key="department.id" :value="department.id">{{ department.department_name }}</option>
          </select>
        </div>
        <div class="col py-3">
          <button class="btn btn-primary" type="submit">Register</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data(){
    return {
      name: ""
    }
  }
};
</script>
