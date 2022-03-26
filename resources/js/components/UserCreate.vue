<template>
  <div class="py-3 justify-content-center flex-column align-items-center">
    <form @submit.prevent="addUser()">
      <div class="container w-25">
        <div class="col py-3">
          <input type="text" v-model="name" class="form-control" :class="{'is-invalid': errors.full_name.length}" placeholder="Full Name">
          <div class="invalid-feedback" v-for="(error, index) in errors.full_name" :key="index">
           {{ error }}
          </div>
        </div>
        <div class="col py-3">
          <input type="email" v-model="email" class="form-control" :class="{'is-invalid': errors.email.length}" placeholder="Email">
          <div class="invalid-feedback" v-for="(error, index) in errors.email" :key="index">
           {{ error }}
          </div>
        </div>
        <div class="col py-3">
          <input type="password" v-model="password" class="form-control" :class="{'is-invalid': errors.password.length}" placeholder="Password">
           <div class="invalid-feedback" v-for="(error, index) in errors.password" :key="index">
            {{ error }}
          </div>
        </div>
        <div class="col py-3">
          <input type="password" v-model="confirm_password" class="form-control" placeholder="Confirm Password">
        </div>
        <div class="col py-3">
          <select name="role" id="" class="form-select" v-model="selected">
            <option v-for="role in roles.data" v-bind:key="role.id" :value="role.id">{{ role.role_name }}</option>
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
      selected: "",
      roles: {
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
  },
  methods:{
    addUser(){
     axios.post('/api/users',{
       full_name: this.name,
       email: this.email,
       password: this.password,
       confirm_password: this.password,
       role_id: this.selected.role_id
     }).then((response)=>{
       alert('User created successfully!')
     }).then((response)=>{
       location.reload()
     }).catch((err)=>{
       console.log(err.response.data)
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
    }
  }
}
</script>