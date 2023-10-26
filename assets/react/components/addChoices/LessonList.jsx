import React, { useState } from 'react'
import LessonItem from './LessonItem';
import {Accordion, AccordionDetails, AccordionSummary} from "@mui/material";
import {ExpandMore} from "@mui/icons-material";

function LessonList({data, MR, user}) {

    const [lessonsInfo, setLessonsInfo] = useState(null);
    const [expanded, setExpanded] = useState(false);

    const LessonClick = () => {
        setLessonsInfo(data["lessonInformation"].map((lessonInfo) => {
            return <LessonItem key={lessonInfo.id} data={lessonInfo} user={user} />
        }));
    }

  return (
      <Accordion sx={{margin: "10px"}}>
          <AccordionSummary expandIcon={<ExpandMore />} onClick={LessonClick}>
              {MR}&nbsp;{data.name}
          </AccordionSummary>
          <AccordionDetails>
                {lessonsInfo}
          </AccordionDetails>
      </Accordion>
  )
}

export default LessonList