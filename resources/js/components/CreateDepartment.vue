<template>
  <div class="py-3 justify-content-center flex-column align-items-center">
    <div class="py-3 justify-content-center flex-column align-items-center" v-if="showCreateDepartment">
      <form @submit.prevent="addDepartment()">
        <div class="container w-25">
          <div class="col py-3">
            <label for="departmentName">Department Name</label>
            <input type="text" id="departmentName" v-model="department_name" class="form-control" :class="{'is-invalid': errors.department_name.length}" placeholder="Department Name">
            <div class="invalid-feedback" v-for="(error, index) in errors.department_name" :key="index">
              {{ error }}
            </div>
          </div>
          <div class="col py-3">
            <label for="roleDescription">Role Name</label>
            <input type="text" id="departmentDescription" v-model="description" class="form-control" :class="{'is-invalid': errors.description.length}" placeholder="Description">
            <div class="invalid-feedback" v-for="(error, index) in errors.description" :key="index">
              {{ error }}
            </div>
          </div>
          <div class="col py-3">
            <button class="btn btn-primary" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
    <div class="d-flex justify-content-center flex-column align-items-center w-30">
      <table class="table w-50">
        <thead>
        <tr>
          <th scope="col">Department Name</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="department in departments.data" :key="department.id"
        >
          <td>{{ department.department_name }}</td>
          <td>{{ department.description }}</td>
          <td>
            <button class="btn btn-primary" @click="editDepartment(department)">edit</button>
            <button class="btn btn-danger" @click="deleteDepartment(department)">delete</button>
          </td>
        </tr>
        </tbody>
      </table>
      <button class="btn btn-secondary" @click="showForm">Create New Department</button>
    </div>
  </div>
</template>
<script>
export default {
  data(){
    return{
      departments:{
        data:[]
      },
      errors:{
        department_name:[],
        description:[]
      },
      department_name: "",
      description: "",
      showEditor: false,
      showDepartmentTable: false,
      showCreateDepartment: false,
      currentDepartment: null
    }
  },
  mounted(){
    this.getDepartments();
  },
  methods:{
    getDepartments(){
      axios.get('/api/departments').then((response) => {
        this.departments = response.data
      })
    },
    addDepartment() {
      axios.post('/api/departments',{
        department_name: this.department_name,
        description: this.description
      }).then((response) => {
        console.log(response)
        alert('Department added successfully')
      }).then((response) => {
        location.reload()
      }).catch((err) => {
        let e = err.response.data
        this.errors.department_name = e.department_name ? e.department_name: []
        this.errors.description = e.description ? e.description: []
      })
    },
    showForm(){
      this.showCreateDepartment = true
      this.department_name = ""
      this.description = ""
    },
    showEditor(){

    }
  }
}
</script>