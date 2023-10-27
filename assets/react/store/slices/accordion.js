import { createSlice } from '@reduxjs/toolkit';

const accordionSlice = createSlice({
    name: 'accordion',
    initialState: {
        active: false,
    },
    reducers: {
        setActive: (state, action) => {
            state.active = action.payload;
        }
    }
});

export const { actions, reducer } = accordionSlice;
export const { setActive } = actions;
export default reducer;
