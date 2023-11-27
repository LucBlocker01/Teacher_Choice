import React from "react";
import {TableCell, TableRow} from "@mui/material";

function ChoiceItemHistory({data}) {
    return (
        <TableRow key={data.id}>
            <TableCell component="th" scope="row">{data.lessonInformation.lesson.name}</TableCell>
            <TableCell align="center">{data.lessonInformation.lesson.subject.semester.name}</TableCell>
            <TableCell align="center">{data.lessonInformation.lesson.subject.name}</TableCell>
            <TableCell calign="center">{data.lessonInformation.lessonType.name}</TableCell>
            <TableCell align="center">{data.nbGroupSelected}</TableCell>
            <TableCell align="center">{data.lessonInformation.nbGroups}</TableCell>
            <TableCell align="center">{data.lessonInformation.lesson.subject.semester.year}</TableCell>
        </TableRow>
    )
}
export default ChoiceItemHistory