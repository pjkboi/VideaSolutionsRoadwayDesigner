<!-- Project picking component (drop down menu and 2 buttons) -->
<template>
  <div id="projectPicker">
    <br>
    <h1>Please select a project</h1>
    <b-form-select
      v-model="selectID"
      id="dropDownPicker"
      @change="onChange($event)"
      :options="getIds"
    >
    </b-form-select>
      <!-- dop down menu project location-->
    <div id="map">
      <!-- map section -->
    </div>
    <b-button id="nextBtn" @click="EditProject" :disabled="disabled">Edit Project</b-button>
  </div>
</template>
<script>
export default {
  props: {
    getIds: Array
  },
  data() {
    return {
      btnString: "roadwayDesigner",
      disabled: false
    };
  },
  methods: {
    // This is taking the data and sending it back to app.vue
    onChange(e) {
      this.$emit("onChange", e);
    },
    forceRefresh() {
      //
      document.getElementById("btnReset").click();
      this.refreshCounter += 1; //we increment this counter to make sure we have a different number for the streetviewer.vue to refresh as much as possible
      this.disabled = false;
    },
    // runs roadwayDesigner on click
    EditProject() {
      if (this.selectID == null || this.selectID == 0) {
        alert("No project selected");
      } else {
        this.$emit("EditProject", "roadwayDesigner"); //This passes the string 'roadwayDesigner' back to the app.vue component to allow for the divs to switch
      }
    }
  }
};
</script>
<style>
h1 {
  margin-top: 5%;
  color: #694393;
}
.map {
  margin: 1%;
}
#projectPicker {
  text-align: center;
}
.custom-select {
  width: 60%;
}
#dropDownPicker {
  height: 100%;
  border: 5px solid #694393;
}
#submitBtn {
  background-color: #694393;
  width: 100px;
}
#nextBtn {
  background-color: #694393;
  width: 100px;
}
</style>
