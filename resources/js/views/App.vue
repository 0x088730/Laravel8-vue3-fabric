<template>
  <div class="container">
    <div class="row justify-content-center">
      <header>
        <nav class="navbar navbar-light bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <img src="/logo.png" alt="fabric" class="d-inline-block align-text-top" />
            </a>
          </div>
        </nav>
      </header>
      <main>
        <DashBoard />
      </main>
    </div>
  </div>
</template>

<script>
import DashBoard from "./Dashboard";
export default {
  name: "Default",
  components: {
    DashBoard,
  },
};
</script>
