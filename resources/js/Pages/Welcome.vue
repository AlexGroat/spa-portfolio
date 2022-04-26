<template>
  <div>Welcome!</div>
</template>
<script>
import { defineComponent } from "vue";

export default defineComponent({
  components: {},

  props: {
    canLogin: Boolean,
    canRegister: Boolean,
  },
});
</script>


