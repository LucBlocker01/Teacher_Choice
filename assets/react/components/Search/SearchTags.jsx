import React from 'react';
import {FormControl, InputLabel, MenuItem, Select} from "@mui/material";

function SearchTags({setInput, input, tags}) {

    function handleChange(event) {
        setInput(event.target.value);
    }

    return (
        <FormControl sx={{
            width: '20%',
            backgroundColor: "secondary.main",
            color: "primary.main"
        }}>
            <InputLabel>
                Liste des tags :
            </InputLabel>
            <Select
                value={input}
                label="Liste des tags :"
                onChange={handleChange}>
                <MenuItem value={'Tous les tags'}>
                    Tous les tags
                </MenuItem>
                {tags}
            </Select>
        </FormControl>
    )
}

export default SearchTags;