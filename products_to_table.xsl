<?xml version="1.0" ?>

<xsl:stylesheet 
  version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
>
  <xsl:template match="/">
      <html>
         <body>
   <table border="1">
        <tr>
          <th>NEWS</th>
      </tr>
        <xsl:for-each select="data/user">
      <tr>
        <td><xsl:value-of select="ENG"/></td>
      </tr>
      </xsl:for-each>
    </table>
         </body>
      </html>>
  </xsl:template>



</xsl:stylesheet>
