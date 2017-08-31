<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <head>
                <title>Add Book</title>
                <link rel="stylesheet" href="/css/lib.css"/>
            </head>
            <body>
                <header>
                    <a href="/library">
                        <img class="library_logo" src="/img/library_logo.png" alt="Library Logo"/>
                        <h1 class="library_title">Library</h1>
                    </a>
                </header>
                <div class="add_book_form_container">
                    <h2>Add Book</h2>
                    <form class="add_book_form" action="/validate" method="post">
                        <xsl:for-each select="//formData/fields/*">
                            <xsl:choose>
                                <xsl:when test="@invalidField = 'true'">
                                    <xsl:element name="input">
                                        <xsl:attribute name="class">invalidField</xsl:attribute>
                                        <xsl:attribute name="value"><xsl:value-of select="."/></xsl:attribute>
                                        <xsl:attribute name="placeholder"><xsl:value-of select="@ph"/></xsl:attribute>
                                        <xsl:attribute name="name"><xsl:value-of select="name()"/></xsl:attribute>
                                        <xsl:attribute name="required"> </xsl:attribute>
                                        <xsl:if test="name() = 'price'">
                                            <xsl:attribute name="type">number</xsl:attribute>
                                            <xsl:attribute name="step">0.05</xsl:attribute>
                                            <xsl:attribute name="min">0.05</xsl:attribute>
                                        </xsl:if>
                                    </xsl:element>
                                    <p class="invalidFieldText">
                                        Invalid Field: <xsl:value-of select="name()"/>
                                    </p>
                                </xsl:when>
                                <xsl:otherwise>
                                    <xsl:element name="input">
                                        <xsl:attribute name="value"><xsl:value-of select="."/></xsl:attribute>
                                        <xsl:attribute name="placeholder"><xsl:value-of select="@ph"/></xsl:attribute>
                                        <xsl:attribute name="name"><xsl:value-of select="name()"/></xsl:attribute>
                                        <xsl:attribute name="required"> </xsl:attribute>
                                        <xsl:if test="name() = 'price'">
                                            <xsl:attribute name="type">number</xsl:attribute>
                                            <xsl:attribute name="step">0.05</xsl:attribute>
                                            <xsl:attribute name="min">0.05</xsl:attribute>
                                        </xsl:if>
                                    </xsl:element>
                                </xsl:otherwise>
                            </xsl:choose>
                        </xsl:for-each>
                        <input value="Submit" type="submit" name="submit" class="submit_button btnAddBook"/>
                        <input value="Reset" type="reset" name="reset" class="submit_button btnResetBook"/>
                        <div class="submit_button btnCancelBook">
                            <a href="/library">Cancel</a>
                        </div>
                    </form>
                </div>
            </body>

        </html>
    </xsl:template>
</xsl:stylesheet>
