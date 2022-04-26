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
            @click="contacting = true"
            >Lets Chat</jet-button
          >
        </div>
      </div>
      <div class="animate-bounce mt-3 text-gray-300 text-center text-9xl">
        <a href="#skills">&#8675;</a>
      </div>
    </Section>

    <Section id="skills" class="bg-gray-200 text-gray-800 h-screen">
      <div class="h-2/3 flex flex-wrap content-between pb-36">
        <h2 class="text-6xl font-bold pt-3 mr-8">Skills</h2>

        <jet-button
          class="
            bg-indigo-800
            rounded
            font-bold
            text-sm text-white-800
            hover:bg-indigo-400
            mt-2
            flex
            justify-center
            mt-10
          "
          @click="contacting = true"
          >Get in touch</jet-button
        >

        <div class="grid grid-cols-2">
          <div v-for="skill in skills">
            <!-- send the background as a computed property -->
            <Skill :background="skill.color">
              {{ skill.name }}
            </Skill>
          </div>
        </div>
      </div>

      <div class="animate-bounce mt-3 text-gray-800 text-center text-9xl">
        <a href="#projects">&#8675;</a>
      </div>
    </Section>

    <Section id="projects" class="bg-gray-600 text-gray-200 h-screen">
      <h2 class="text-6xl font-bold pt-3">Projects</h2>
      <div class="flex flex-wrap justify-center mt-10">
        <jet-button
          class="
            bg-purple-300
            rounded
            font-bold
            text-sm text-gray-700
            hover:bg-purple-400
            mt-2
          "
          @click="contacting = true"
          >Know more</jet-button
        >
        <!-- from the full list of projects, we need to define which is the icon we resolve for -->
        <div class="mx-8" v-for="(project, index) in projects">
          <Project
            :title="project.title"
            :description="project.description"
            :color="project.color"
          >
            <!-- dynamically name this component, receive the index of the project that we are looping through 
            component name is resolved by the function, function is called for every loop over projects -->
            <component :is="componentName(index)"></component>
          </Project>
        </div>
      </div>
    </Section>

    <Section class="flex justify-between bg-gray-800 text-gray-300 text-xl">
      <p>&copy; AlexGroat. All Rights Reserved.</p>
      <div class="flex justify-evenly items-center">
        <Link
          class="border-b pb-2 px-2 hover:text-gray-500"
          href="https://github.com/AlexGroat"
          >Github</Link
        >
        <Link class="border-b pb-2 px-2 hover:text-gray-500" href=""
          >Twitter</Link
        >
        <Link class="border-b pb-2 px-2 hover:text-gray-500" href=""
          >StackOverflow</Link
        >
      </div>
    </Section>
  </div>
  <!--  on click of jetstream button the value of the contacting 
  modal is set to true which displays the jet modal, upon clicking
  away from the modal the value is set back to null and the modal 
  closes -->
  <jet-modal :show="contacting" closeable="true" @close="contacting = null">
    <div class="bg-gray-50 shadow-2xl p-6 mx-10">
      <p class="text-gray-600 text-2xl font-extrabold text-center">
        Please fill in some details
      </p>

      <form @submit.prevent="submit" class="flex flex-col itemrs-center p-16">
        <jet-input
          class="px-5 py-3 w-96 border border-gray-600 rounded ml-4"
          type="email"
          name="email"
          placeholder="Email"
          v-model="form.email"
        ></jet-input>
        <jet-input-error :message="form.errors.email" />
        <!-- form property declared in data() -->

        <textarea
          class="px-5 py-3 w-96 border border-gray-600 rounded ml-4 mt-5"
          name="message"
          placeholder="Details"
          v-model="form.message"
        ></textarea>
        <jet-input-error :message="form.errors.message" />

        <jet-button
          class="
            px-5
            py-3
            mt-5
            w-96
            bg-purple-400
            justify-center
            rounded-xl
            text-sm
            ml-4
          "
          :disabled="form.processing"
          ><span class="animate-spin mr-1" v-show="form.processing"
            >&#9696;</span
          >

          <span v-show="!form.processing">Get in touch</span>
        </jet-button>
      </form>
    </div>
  </jet-modal>
</template>
<script>
import { defineAsyncComponent, defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetButton from "@/Jetstream/Button";
import JetModal from "@/Jetstream/Modal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";

import Section from "@/Components/Section.vue";
import Skill from "@/Components/Skills.vue";
import Project from "@/Components/Projects.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    Section,
    JetApplicationMark,
    JetButton,
    JetModal,
    JetInput,
    JetInputError,
    Skill,
    Project,
  },

  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    skills: Object,
    projects: Object,
  },

  methods: {
    componentName(index) {
      // async components let us create a component in real time so we can see something while the async component is loading
      return defineAsyncComponent(() =>
        import(
          "@heroicons/vue/solid/" + this.projects[index].icon_name + "Icon.js"
        )
      );
    },
    // submit method called on @submit.prevent="submit"
    submit() {
      // submit a post request to the contact route
      this.form.post(route("contact"));
    },
  },

  // not static properties
  data() {
    return {
      contacting: null,
      form: this.$inertia.form({
        email: "",
        message: "",
      }),
    };
  },
});
</script>

// defineAsyncComponent imports a hero icons solid icon which dynamically changes the name from the customization.json file

// camel case jett application mark from jetstream


