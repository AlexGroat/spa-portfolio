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
</template>
<script>
import { defineAsyncComponent, defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetButton from "@/Jetstream/Button";

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
  },
});
</script>

// defineAsyncComponent impots a hero icons solid icon which dynamically changes the name from the customization.json file

// camel case jett application mark from jetstream


