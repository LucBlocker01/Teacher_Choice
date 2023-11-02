import React, { useState } from 'react'
import LessonItem from './LessonItem';
import {Accordion, AccordionDetails, AccordionSummary} from "@mui/material";
import {ExpandMore} from "@mui/icons-material";
import { useSelector, useDispatch } from "react-redux";
import { setActive} from "../../store/slices/accordion";

function LessonList({data, MR, user}) {

    const [lessonsInfo, setLessonsInfo] = useState(null);
    const accordionRedux = useSelector((state) => state.accordion);
    const dispatch = useDispatch();
    const LessonClick = () => {
        setLessonsInfo(data["lessonInformation"].map((lessonInfo) => {
            return <LessonItem key={lessonInfo.id} data={lessonInfo} user={user} />
        }));
    }

    const handleChangeAccordion = (panel) => (event, isExpanded) => {
        if (panel === accordionRedux.active) {
            dispatch(setActive(false));
        } else {
            dispatch(setActive(panel));
        }
    }

  return (
      <Accordion
          expanded={accordionRedux.active === data.id}
          sx={{margin: "10px", backgroundColor: "secondary.main", display: "flex", flexDirection: "column", alignItems: "center"}}
          onChange={handleChangeAccordion(data.id)}>
          <AccordionSummary expandIcon={<ExpandMore />} onClick={LessonClick} sx={{width: "auto"}}>
              {MR}&nbsp;{data.name}
          </AccordionSummary>
          <AccordionDetails sx={{backgroundColor: "secondary.main", justifyContent:"center", alignItems: "center", display: "flex"}}>
                {lessonsInfo}
          </AccordionDetails>
      </Accordion>
  )
}

export default LessonList