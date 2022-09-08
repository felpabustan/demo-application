<template>
  <div class="py-3 justify-content-center flex-column align-items-center">
    <form @submit.prevent="addUser()">
      <div class="container w-25">
        <div class="col py-3">
          <label for="fullName">Full Name</label>
          <input type="text" id="fullName" v-model="name" class="form-control" :class="{'is-invalid': errors.full_name.length}">
          <div class="invalid-feedback" v-for="(error, index) in errors.full_name" :key="index">
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
          <label for="password">Password</label>
          <input type="password" id="password" v-model="password" class="form-control" :class="{'is-invalid': errors.password.length}">
           <div class="invalid-feedback" v-for="(error, index) in errors.password" :key="index">
            {{ error }}
          </div>
        </div>
        <div class="col py-3">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" id="confirmPassword" v-model="confirm_password" class="form-control">
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
    return{
      name: "",
      email: "",
      password: "",
      confirm_password: "",
      role_id: "",
      department_id: "",
      roles: {
        data: []
      },
      departments: {
        data: []
      },
      errors:{
        full_name:[],
        email:[],
        password:[]
      }
    }
  },
  mounted(){
    this.getRoles();
    this.getDepartments();
  },
  methods:{
    addUser(){
     axios.post('/api/users',{
       full_name: this.name,
       email: this.email,
       password: this.password,
       confirm_password: this.password,
       department_id: this.department_id
     }).then((response)=>{
       alert('User created successfully!')
     }).then((response)=>{
       location.reload()
     }).catch((err)=>{
       let e = err.response.data.errors
       this.errors.full_name = e.full_name ? e.full_name : []
       this.errors.email = e.email ? e.email : []
       this.errors.password = e.password ? e.password : []
     })
    },
    getRoles(){
      axios.get('/api/roles').then((response) =>{
        this.roles = response.data;
      })
    },
    getDepartments(){
      axios.get('/api/departments').then((response) => {
        this.departments = response.data;
      })
    }
  }
}
</script>