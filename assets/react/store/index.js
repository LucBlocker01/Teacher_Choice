import { configureStore } from "@reduxjs/toolkit";
import accordionReducer from "./slices/accordion";

const store = configureStore({
    reducer: {
        accordion: accordionReducer,
    },
});

export default store;