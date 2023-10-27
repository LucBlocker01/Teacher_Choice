import React, {useState} from "react";
import {Button, TableCell, TableRow, TextField} from "@mui/material";
import {deleteChoiceById, PatchTeacherChoiceById} from "../../services/api/api";
import {func} from "prop-types";


function TeacherChoiceItem({ data }) {
    const handleInput = () => {
        var nbAttributed = document.getElementById(data.id).value;
        const maxGroups = data.lessonInformation.nbGroups;
        if (nbAttributed <= maxGroups && nbAttributed >= 0){
            console.log(nbAttributed);
            PatchTeacherChoiceById(data.id, nbAttributed);
        }

    }
    return (
        <TableRow>
            <TableCell component="th" scope="row">{data.lessonInformation.lesson.name}</TableCell>
            <TableCell align="right">{data.lessonInformation.lesson.subject.name}</TableCell>
            <TableCell align="right">{data.nbGroupSelected}</TableCell>
            <TableCell align="right">{data.lessonInformation.nbGroups}</TableCell>
            <TableCell align="right">{data.lessonInformation.lessonType.name}</TableCell>
            <TableCell align="right">
                <input
                    id={data.id}
                    onChange={handleInput}
                    type="number"
                    min="0"
                    max={data.lessonInformation.nbGroups}
                    placeholder={data.nbGroupAttributed}
                    />
            </TableCell>
        </TableRow>
    );
}

export default TeacherChoiceItem;