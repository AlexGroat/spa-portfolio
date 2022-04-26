<template>
  <div>
    <section class="bg-gray-800 pt-16 h-screen px-72">
      <div class="h-2/3 flex flex-wrap content-between pb-36">
        <p
          class="
            border-b-2
            font-bold
            text-white
            border-gray-400
            pb-3
            text-2xl
            uppercase
          "
        >
          Hey! This is Alex. I'm a software developer.
        </p>
      </div>
    </section>

    <section class="bg-gray-200 text-gray-800 px-72 py-10 h-screen">
      <h2 class="text-6xl font-bold pt-3">Skills</h2>
    </section>

    <section class="bg-gray-600 text-gray-200 px-72 py-10 h-screen">
      <h2 class="text-6xl font-bold pt-3">Projects</h2>
    </section>

    <section class="flex justify-between py-10 px-72 bg-gray-800 text-gray-300 text-xl">
      <p>&copy; AlexGroat. All Rights Reserved.</p>
      <div class="flex justify-evenly items-center">Github Twitter StackOverflow</div>
    </section>
  </div>
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


