<template>
  <div class="d-flex justify-content-center flex-column align-items-center">
    <div v-if="deleteAlert" class="alert alert-success" role="alert">
      User deleted successfully!
    </div>
    <div class="container" v-if="showEditor">
      <h1 class="d-flex justify-content-center flex-column align-items-center">Edit User</h1>
      <form @submit.prevent="submitEdit">
        <div class="container w-50">
          <div class="col py-3">
            <label for="editorFullName">Full Name</label>
            <input type="text" id="editorFullName" v-model="currentUser.name" class="form-control" placeholder="Name">
          </div>
          <div class="col py-3">
            <label for="editorEmail">Email</label>
            <input type="email" id="editorEmail" v-model="currentUser.email" class="form-control" placeholder="Email">
          </div>
          <div class="col py-3">
            <label for="editorRole">Role</label>
            <select name="role" id="editorRole" class="form-select" v-model="currentUser.role_id">
              <option v-for="role in roles.data" v-bind:key="role.id" :value="role.id">{{ role.role_name }}</option>
            </select>
          </div>
          <div class="col py-3">
            <button class="btn btn-primary" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
    <div class="d-flex justify-content-center align-items-center" v-if="!showEditor">
      <span>
        <h3>List of Users</h3>
      </span>
    </div>
    <div class="d-flex justify-content-center flex-column align-items-center w-100" v-if="!showEditor">
        <table class="table w-50">
          <thead>
            <tr>
              <th scope="col">Full Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="user in users.data" :key="user.id"
            >
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.role?user.role.role_name:"" }}</td>
              <td>
                <button class="btn btn-primary" @click="editUser(user)">edit</button>
                <button class="btn btn-danger" @click="deleteUser(user)">
                  delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
  </div>
</template>
<script> 
export default {
  data(){
    return{
      users: {
        data:[]
      },
      name: "",
      email: "",
      password: "",
      confirm_password: "",
      role: "",
      roles: {
        data: []
      },
      deleteAlert: false,
      showEditor: false,
      currentUser: null
    }
  },
  mounted(){
    this.getUsers();
    this.getRoles();
  },
  methods:{
    getUsers() {
      axios.get("/api/users").then((response) => {
        this.users = response.data
      })
    },
    deleteUser(user){
      this.deleteUser = false;
      axios.delete(`/api/users/${user.id}`).then((response) => {
        this.getUsers();
        this.deleteAlert = true;
      }).then((response)=>{
         location.reload();
      })
    },
    editUser(user){
      this.showEditor = true;
      this.currentUser = user
    },
    getRoles(){
      axios.get('/api/roles').then((response) =>{
        this.roles = response.data;
      })
    },
    submitEdit(){
      axios.put(`/api/users/${this.currentUser.id}`,{
        full_name: this.currentUser.name,
        email: this.currentUser.email,
        role_id: this.currentUser.role_id
      }).then((response)=>{    
        this.getUsers()
        this.currentUser = null
        this.showEditor = false
      })
    }
  }
}
</script>