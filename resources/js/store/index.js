import { createStore, createLogger } from "vuex";

function loadBase() {
  const context = require.context("./modules", false, /.*\.js$/);
  return context
    .keys()
    .map(context) // import module
    .map((m) => m.default); // get `default` export from each resolved module
}

const coreModules_ = {};

loadBase().forEach((resource) => {
  coreModules_[resource.name] = resource;
});

const modules = {
  ...coreModules_,
};

export default createStore({
  modules,
});
