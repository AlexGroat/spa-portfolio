<template>
  <Head title="Welcome" />

  <Section class="grid grid-cols-2 text-right bg-gray-800 text-gray-300">
    <div>
      <jet-application-mark class="h-12 mx-auto"></jet-application-mark>
    </div>
    <div v-if="canLogin">
      <Link
        v-if="$page.props.user"
        :href="route('dashboard')"
        class="text-sm underline"
        >Dashboard
      </Link>

      <template v-else>
        <Link :href="route('login')" class="text-base underline">Log in</Link>

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="text-base underline place-self-end ml-4"
          >Register</Link
        >
      </template>
    </div>
  </Section>
  <div>
    <Section class="bg-gray-800 pt-16 h-screen">
      <div>
        <div class="h-2/3 flex flex-wrap content-between pb-36">
          <p
            class="
              border-b-2
              font-bold
              text-white
              border-gray-500
              pb-3
              text-2xl
              uppercase
            "
          >
            Hey! This is Alex. I'm a software developer.
          </p>
        </div>

        <div class="flex flex-wrap content-between pb-36">
          <p
            class="
              border-b-2
              font-bold
              text-gray-400
              border-gray-500
              pb-3
              text-2xl
              uppercase
              mr-4
            "
          >
            Get in contact with me.
          </p>
          <jet-button
            class="
              bg-green-400
              rounded
              font-bold
              text-sm text-gray-800
              hover:bg-green-800
              mb-2
            "
            >Lets Chat</jet-button
          >
        </div>
      </div>
      <div class="animate-pulse mt-3 text-gray-300 text-center text-9xl">
        <a href="#skills">&#8675;</a>
      </div>
    </Section>

    <Section id="skills" class="bg-gray-200 text-gray-800 h-screen">
      <h2 class="text-6xl font-bold pt-3">Skills</h2>
      <div class="flex justify-center mt-10">
        <jet-button
          class="
            bg-indigo-800
            rounded
            font-bold
            text-sm text-white-800
            hover:bg-indigo-400
            mt-2
          "
          >Get in touch</jet-button
        >
      </div>
    </Section>

    <Section class="bg-gray-600 text-gray-200 h-screen">
      <h2 class="text-6xl font-bold pt-3">Projects</h2>
      <div class="flex justify-center mt-10">
        <jet-button
          class="
            bg-purple-300
            rounded
            font-bold
            text-sm text-gray-700
            hover:bg-purple-400
            mt-2
          "
          >Know more</jet-button
        >
      </div>
    </Section>

    <Section class="flex justify-between bg-gray-800 text-gray-300 text-xl">
      <p>&copy; AlexGroat. All Rights Reserved.</p>
      <div class="flex justify-evenly items-center">
        Github Twitter StackOverflow
      </div>
    </Section>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetButton from "@/Jetstream/Button";
import Section from "@/Components/Section.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    Section,
    JetApplicationMark,
    JetButton,
  },

  props: {
    canLogin: Boolean,
    canRegister: Boolean,
  },
});
</script>

// camel case jett application mark from jetstream


