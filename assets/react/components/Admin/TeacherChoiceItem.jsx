import React, {useState} from "react";
import {Button, TableCell, TableRow} from "@mui/material";


function TeacherChoiceItem({ data }) {
    const [value, setValue] = useState(data.nbGroupAttributed);
    return (
        <TableRow>
            <TableCell component="th" scope="row">{data.lessonInformation.lesson.name}</TableCell>
            <TableCell align="right">{data.lessonInformation.lesson.subject.name}</TableCell>
            <TableCell align="right">{data.nbGroupSelected}</TableCell>
            <TableCell align="right">{data.lessonInformation.nbGroups}</TableCell>
            <TableCell align="right">{data.lessonInformation.lessonType.name}</TableCell>
            <TableCell align="right"><input onChange={() => setValue(value)} type="number" value={value}/></TableCell>
        </TableRow>
    );
}

export default TeacherChoiceItem;