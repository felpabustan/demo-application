<template>
<div class="container w-30 px-3 py-5 align-items-center" style="width: 500px;">
  <h4>RedCore Assessment Login</h4>
  <form @submit.prevent="login">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input v-model="form.email" type="email" class="form-control" :class="{'is-invalid': errors.email.length}" id="exampleInputEmail1" required>
      <div class="invalid-feedback" v-for="(error, index) in errors.email" :key="index">
        {{ error }}
      </div>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input v-model="form.password" type="password" class="form-control" :class="{'is-invalid': errors.password.length}" id="exampleInputPassword1" required>
      <div class="invalid-feedback" v-for="(error, index) in errors.password" :key="index">
        {{ error }}
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</template>
<script>
export default {
  data(){
    return{
      form : {
        email : "",
        password : ""
      },
      errors:{
        email: [],
        password: []
      }
    }
  },
  methods:{
    login(){
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/login', this.form).then(response =>{
          location.reload()
        }).catch((err)=>{
          console.log(err.response.data)
          let e = err.response.data.errors
          this.errors.email = e.email ? e.email : []
          this.errors.password = e.password ? e.password : []
        })
      });
    }
  }
}
</script>