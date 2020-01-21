<template>
  <div id="app">
    <!-- navbar made with bootstrap -->
    <div id="navbar">
      <b-navbar toggleable="md" type="dark" id="navbar">
        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
        <b-navbar-brand href="#">VIDEA</b-navbar-brand>
        <vue-xlsx-table
          @on-select-file="handleSelectedFile"
          v-show="openFilebtn"
          >open dbf</vue-xlsx-table
        >
        <b-collapse is-nav id="nav_collapse">
          <b-navbar-nav class="ml-auto">
            <span class="nav-item" @click="pageSwitcher('ProjectPicker')">
              <img src="./icons/map.png" />Map
            </span>
            <span class="nav-item" @click="pageSwitcher('roadwayDesigner')">
              <img src="./icons/roadway.png" /> Roadway Designer
            </span>
            <span class="nav-item" @click="pageSwitcher('Dashboard')">
              <img src="./icons/dashboard.png" /> Dashboard
            </span>
          </b-navbar-nav>
        </b-collapse>
      </b-navbar>
    </div>
    <!-- inserting components in the body of the application -->
    <ProjectPicker
      v-show="projectPickerSwitch"
      v-on:EditProject="dataSorter($event)"
      v-on:onChange="selectedIdRetriever($event)"
      :getIds="getIds"
    ></ProjectPicker>
    <!-- projectpicker component which passes a string back to change whats on screen to the next component -->
    <RoadwayDesigner
      v-show="roadWayDesignerSwitch"
      :getData="getData"
      :convertedDataStorage="convertedDataStorage"
    ></RoadwayDesigner>
    <Admin v-if="adminPg" v-on:Admin="AdminSwitch($event)"></Admin>
    <button id="adminbtn" v-show="adminbtn" @click="pageSwitcher('Admin')"
      >Admin</button >
      <!-- pageSwitcher('Admin') -->
   
  </div>
</template>

<script>
//importing all crucial components from src file
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import ProjectPicker from "./projectPicker.vue";
import RoadwayDesigner from "./RoadwayDesigner.vue";
import Admin from "./Admin.vue";
export default {
  //declaring the components
  components: {
    ProjectPicker,
    RoadwayDesigner,
    Admin
  },
  name: "app",
  data() {
    return {
      //declaring switch variables
      projectPickerSwitch: true, // true is active
      roadWayDesignerSwitch: false, // false is inactive
      dashboardSwitch: false,
      adminbtn: true,
      adminPg: false,
      openFilebtn: false,
      crossSectionArray: [], //this is going to be the container that holds all the instances of the dbf file
      getData: {}, // data object var
      getName: [], // name of columns array
      getValue: [], // values of querry
      getIds: [],
      convertedDataStorage: {}
    };
  },
  created(){
    axios.get('/api/welcome/show')
                 .then((res) => {
                  this.getIds = res.data;
                  console.log(res.data);
               })
               .catch(error => {
                console.log(error.response)
        });
  },
  methods: {
    // a method switches the components within the application
    pageSwitcher(switcher) {
      switch (switcher) {
        case "ProjectPicker":
          (this.projectPickerSwitch = true),
            (this.roadWayDesignerSwitch = false),
            (this.dashboardSwitch = false),
            (this.adminbtn = true),
            (this.adminPg = false);
          break;
        case "roadwayDesigner":
          (this.projectPickerSwitch = false),
            (this.roadWayDesignerSwitch = true),
            (this.dashboardSwitch = false),
            (this.adminbtn = false),
            (this.adminPg = false);

          break;
        case "Dashboard":
          (this.projectPickerSwitch = false),
            (this.roadWayDesignerSwitch = false),
            (this.dashboardSwitch = true),
            (this.adminbtn = false),
            (this.adminPg = false);
          break;
        case "Admin":
          (this.projectPickerSwitch = false),
            (this.roadWayDesignerSwitch = false),
            (this.dashboardSwitch = false),
            (this.adminbtn = false),
            (this.adminPg = true);
          break;
      }
    },
    AdminSwitch(e) {
      this.openFilebtn = e;
    },
    selectedIdRetriever(event) {
      axios.get('/api/welcome/'+ event, {
                    params:{
                      event}
                })
                 .then((res) => {
                   this.getData = res.data;
                  console.log(res.data);
               })
               .catch(error => {
                console.log(error.response)
        });
    },
    dataSorter(switcher) {
      this.pageSwitcher(switcher);
      document.getElementById("btnReset").click();
      document.getElementById("RDPrepopulation").click();
    },
    handleSelectedFile(convertedData) {
      this.convertedDataStorage = convertedData;
      this.getIds = [];
      axios.post('/api/welcome/store', {
              ConvertedData: this.convertedDataStorage
          })
            .then((res) => {
              console.log(res);
          })
          .catch(error => {
          console.log(error.response)
        });
    }
  }
};
</script>

<style lang="scss">
#navbar {
  background-color: #694393;
  z-index: 100;
}
.nav-item {
  padding-left: 10px;
  color: white;
}
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
#adminbtn {
  position: fixed;
  top: 90%;
  margin: 1em;
}
</style>
