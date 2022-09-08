<template>
  <div class="d-flex justify-content-center flex-column align-items-center">
    <div v-if="deleteAlert" class="alert alert-success" role="alert">
      User deleted successfully!
    </div>
    <div class="container" v-if="showEditor">
      <h3 class="d-flex justify-content-center flex-column align-items-center">Edit User</h3>
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
            <label >Department</label>
            <select name="department" id="editorDepartment" class="form-select" v-model="currentUser.department_id">
              <option v-for="department in departments.data" v-bind:key="department.id" >{{ department.department_name }}</option>
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
        <h3>List of Employees</h3>
      </span>
    </div>
    <div class="d-flex justify-content-center flex-column align-items-center w-100" v-if="!showEditor">
        <table class="table w-50">
          <thead>
            <tr>
              <th scope="col">Full Name</th>
              <th scope="col">Email</th>
              <th scope="col">Department</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="user in users.data" :key="user.id"
            >
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.department?user.department.department_name:"" }}</td>
              <td>
                <button class="btn btn-primary" @click="editUser(user)">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                    <path d="M16 5l3 3"></path>
                  </svg>
                </button>
                <button class="btn btn-danger" @click="deleteUser(user)">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="4" y1="7" x2="20" y2="7"></line>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                  </svg>
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
      departments: {
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
    this.getDepartments();
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
    getDepartments(){
      axios.get('/api/departments').then((response) => {
        console.log(response.data);
        this.departments = response.data;
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
      }).then((response) => {
        alert('User details updated')
      })
    }
  }
}
</script>