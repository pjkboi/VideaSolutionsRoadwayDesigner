<template>
  <div id="app">
    <v-app id="inspire">
      <v-content v-show="!logged">
        <v-container fluid fill-height>
          <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
              <v-card class="elevation-12">
                <v-toolbar dark color="#694393">
                  <v-toolbar-title>Login form</v-toolbar-title>
                  <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-text>
                  <v-form>
                    <v-text-field v-model="email" label="E-mail" required></v-text-field>
                    <v-text-field
                      v-model="password"
                      label="Password"
                      id="password"
                      type="password"
                      required
                    ></v-text-field>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="#694393" style="color:white;" @click="onSubmit">Login</v-btn>
                      <v-btn color="#694393" style="color:white;" @click="onReset">Clear</v-btn>
                    </v-card-actions>
                  </v-form>
                </v-card-text>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-content>
      <v-card height="100%" v-if="logged">
        <div id="internals">
          <div id="standards" v-if="switcher.standards">
            Hallo standards!
            <v-container fluid grid-list-xl>
              <v-layout wrap align-center>
                <v-flex xs5>
                  <v-subheader>Selected Standard</v-subheader>
                </v-flex>
                <v-flex xs12 sm6 d-flex>
                  <v-select
                    :items="standardsPHP"
                    label="Standard"
                    :value="standardsPHP[0]"
                  ></v-select>
                </v-flex>
              </v-layout>
            </v-container>
            <v-btn color="success" @click="standardForm = true">Add a new Standard</v-btn>
            <div v-if="standardForm" style="margin-top:20px">
              <h3>Create a new Standard
                  named as 
                  <v-flex xs12 md1 style="float: none;">
                  <v-text-field
                    v-model="newStandardName"
                    :counter="15"
                    label="Standard Name"
                    required
                  ></v-text-field></v-flex>
              </h3>
              <v-container >
                <v-layout row wrap>
              <v-flex v-for="standard in newStandards" :key="standard.title" class="standardElements" style="width: 541px;" xs4>
               
                  <v-subheader @click="test()">{{standard.title}}</v-subheader>
                  <v-card-text>
                    <v-layout row >
                    <v-flex shrink style="width: 40px" >
                      <v-text-field
                        v-model="standard.value[0]"
                        class="mt-0"
                        hide-details
                        single-line
                        type="number"
                      ></v-text-field>
                    </v-flex>
                    <v-flex class="px-3" xs4>
                      <v-range-slider
                        v-model="standard.value"
                        thumb-label="always"
                        :max="10"
                        :min="0.1"
                          :step="0.1"
                      ></v-range-slider>
                    </v-flex>
                    <v-flex shrink style="width: 40px" >
                      <v-text-field
                        v-model="standard.value[1]"
                        class="mt-0"
                        hide-details
                        single-line
                        type="number"
                      ></v-text-field>
                    </v-flex>
                    </v-layout>
                  </v-card-text>
                  </v-flex>
                </v-layout>
               </v-container>
              <v-btn color="success" style="float: right; margin: 20px;" >Add</v-btn>
            </div>
          </div>
          <div id="users" v-if="switcher.users" >
            <div style="display: flex;flex-direction: row; margin: 30px">
              <div class="col-4" style="overflow-y: scroll; height:400px;">
              <h3>Users</h3>

              <draggable
                id="first"
                data-source="juju"
                :list="list"
                class="list-group"
                draggable=".item"
                group="a"
              >
                <div
                  class="list-group-item item"
                  v-for="element in list"
                  :key="element.name"
                >
                <v-icon left>remove_circle</v-icon>
                  {{ element.name }}
                </div>

                <div
                  slot="footer"
                  class="btn-group list-group-item"
                  role="group"
                >
                  <button class="btn btn-secondary" @click="add">Add</button>
                </div>
              </draggable>
            </div>

            <div class="col-4" style="overflow-y: scroll; height:400px;">
              <h3>Admins</h3>

              <draggable :list="list2" class="list-group" draggable=".item" group="a" >
                <div
                  class="list-group-item item"
                  v-for="element in list2"
                  :key="element.id"
                >
                <v-icon left @click="removePerson(element.id)">remove_circle</v-icon>
                  {{ element.name }}
                  
                </div>

                <div
                  slot="footer"
                  class="btn-group list-group-item"
                  role="group"
                >
                  <button class="btn btn-secondary" @click="add2">Add</button>
                </div>
              </draggable>
             </div>
            </div>
            <v-btn color="success" @click="showUser">Add a User</v-btn>
            <modal name="add-user" width="700px"  height="400px">
              <form style="padding: 20px">
                <fieldset>
                  <legend>Personal information:</legend>
                  First name:
                  <v-flex xs12 sm6>
                    <v-text-field
                      label="First Name"
                      single-line
                    ></v-text-field>
                 </v-flex>
                  <br>
                  Last name:
                  <v-flex xs12 sm6>
                    <v-text-field
                      label="Last Name"
                      single-line
                    ></v-text-field>
                 </v-flex>
                  <br><br>
                  <v-btn color="success" @click="add(), hideUser()">Add</v-btn>
                </fieldset>
              </form>
            </modal>
          </div>
          <div id="data" v-if="switcher.data">
            Hallo data! <br><br>
            

            <vue-xlsx-table
          >open dbf</vue-xlsx-table
        >
          </div>
        </div>
      <v-navigation-drawer
        v-model="drawer"
        permanent
        absolute
      >
        <v-toolbar flat class="transparent">
          <v-list class="pa-0">
            <v-list-tile avatar>
              <v-list-tile-avatar>
                <img src="https://randomuser.me/api/portraits/men/85.jpg">
              </v-list-tile-avatar>
              <v-list-tile-content>
                <v-list-tile-title>John Admin</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
        </v-toolbar>
        <v-list class="pt-0" dense>
          <v-divider></v-divider>
          <v-list-tile
            v-for="item in menuItems"
            @click="switchFunction(item.title)"
            :key="item.title"
          >
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
  
            <v-list-tile-content>
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-navigation-drawer>
    </v-card>
    </v-app>
  </div>
</template>
<script>
import draggable from 'vuedraggable';
let id = 1;
export default {
   name: "two-list-headerslots",
   display: "Two list header slot",
   order: 14,
  components: {
    draggable
  },
  data() {
    return {
      
      email: "",
      password: "",
      admin: {
        name: "admin@admin.com",
        pw: "admin"
      },
      list: [
        { name: "John 1", id: 0 },
        { name: "Joao 2", id: 1 },
        { name: "Jean 3", id: 2 }
      ],
      list2: [{ name: "Jonny 4", id: 0 },
       { name: "Guisepe 5", id: 1 }],
      show: true,
      logged: false,
      drawer: true,
      standardForm: false,
      newStandardName: "",
      switcher: {
        standards: true,
        users: false,
        data: false,
      },
      standardsPHP: ['NACTO', 'NotNACTO', 'Standard'],
      menuItems: [
        { title: 'Standards', icon: 'book' },
        { title: 'Users', icon: 'supervised_user_circle' },
        { title: 'Data', icon: 'assignment' }
      ],
      newStandards: [
        {title: 'comm_ext', value: [0,0]},
        {title: 'sdwlk_path_res', value: [0,0]},
        {title: 'sdwlk_path_res1', value: [0,0]},
        {title: 'sdwlk_path_res2', value: [0,0]},
        {title: 'sdwlk_path_res3', value: [0,0]},
        {title: 'sdwlk_path_res4', value: [0,0]},
        {title: 'sdwlk_path_res5', value: [0,0]},
        {title: 'sdwlk_path_res6', value: [0,0]},
        {title: 'sdwlk_path_res7', value: [0,0]},
        {title: 'sdwlk_path_res8', value: [0,0]},
        {title: 'sdwlk_path_res9', value: [0,0]},
        {title: 'sdwlk_path_res0', value: [0,0]},
        {title: 'sdwlk_path_res11', value: [0,0]},
        {title: 'sdwlk_path_res12', value: [0,0]},
        {title: 'sdwlk_path_res13', value: [0,0]},
        {title: 'sdwlk_path_res123', value: [0,0]},
        {title: 'sdwlk_path_res132', value: [0,0]},
        {title: 'sdwlk_path_res432', value: [0,0]},
        {title: 'sdwlk_path_res545', value: [0,0]},
        {title: 'sdwlk_path_res575', value: [0,0]},
        {title: 'sdwlk_path_res765', value: [0,0]},
        {title: 'sdwlk_path_res975', value: [0,0]},
        {title: 'sdwlk_path_res573', value: [0,0]},
        {title: 'sdwlk_path_res264', value: [0,0]},
        {title: 'sdwlk_path_res824', value: [0,0]},
        {title: 'sdwlk_path_res146', value: [0,0]},
        {title: 'sdwlk_path_res621', value: [0,0]},
        {title: 'sdwlk_path_res246', value: [0,0]},
        {title: 'sdwlk_path_res854', value: [0,0]},
        {title: 'sdwlk_path_res967', value: [0,0]},
        {title: 'sdwlk_path_res888', value: [0,0]},
        {title: 'sdwlk_path_res777', value: [0,0]},
        {title: 'sdwlk_path_res656', value: [0,0]},
        {title: 'sdwlk_path_res454', value: [0,0]},
        {title: 'sdwlk_path_res343', value: [0,0]},
        {title: 'sdwlk_path_res323', value: [0,0]}
      ],
      mini: true,
      right: null
    };
  },
  methods: {
    removePerson(index){
      this.list2.splice(0, index);
    },
    showUser() {
      this.$modal.show("add-user");
    },
    hideUser() {
      this.$modal.hide("add-user");
    },
    add: function() {
          this.list.push({ name: "Juan " + id, id: id++ });
        },
        replace: function() {
          this.list = [{ name: "Edgard", id: id++ }];
        },
        add2: function() {
          this.list2.push({ name: "Juan " + id, id: id++ });
        },
        replace2: function() {
          this.list2 = [{ name: "Edgard", id: id++ }];
        },
    switchFunction(title){
      switch (title) {
        case "Standards":
          this.switcher.standards = true;
          this.switcher.users = false;
          this.switcher.data = false;
          break;
        case "Users":
          this.switcher.standards = false;
          this.switcher.users = true;
          this.switcher.data = false;
          break;
        case "Data":
          this.switcher.standards = false;
          this.switcher.users = false;
          this.switcher.data = true;
          break;
      }
    },
    onSubmit(evt) {
      if (this.email == this.admin.name && this.password == this.admin.pw) {
        this.$emit("Admin", this.show);
        this.logged = true
      } else {
        alert("Not the admin");
      }
      evt.preventDefault();
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.email = "";
      this.password = "";
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    }
  }
};
</script>
<style>
#internals {
margin-left: 310px;
}
::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
}
#input {
  border-radius: 4px;
}
::-webkit-scrollbar
{
	width: 5px;
	background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
	background-color: #000000;
	border: 1px solid #555555;
}


</style>
