import React, { useState } from 'react'

function History() {

    const [history, setHistory] = useState([])

  return (
    <>
    <h1>Historique de vos voeux de vos année précédentes : </h1>

    {history.length > 0 ? (<p>t</p>) : (<p>Aucune années trouvé</p>) }
    </>
  )
}

export default History