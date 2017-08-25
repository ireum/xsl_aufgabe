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
                        <h1>XSL Library</h1>
                    </a>
                </header>
                <div class="add_book_form_container">
                    <h2>Add Book</h2>
                    <form class="add_book_form" action="/validate" method="post">

                        <xsl:choose>
                            <xsl:when test="//formData/exception/@bool = 'true'">
                                <xsl:for-each select="//formData/fields/*">
                                    <xsl:choose>
                                        <xsl:when test="name() = //formData/invalidField">
                                            <xsl:choose>
                                                <xsl:when test="name() = 'price'">
                                                    <input class="invalidField" value="{.}" placeholder="{@ph}" type="number" min="0.05" step="0.05" name="{name()}"
                                                           required=""/>
                                                    <p class="invalidFieldText">
                                                        <xsl:value-of select="//formData/exceptionMessage"/>
                                                    </p>
                                                </xsl:when>
                                                <xsl:otherwise>
                                                    <input class="invalidField" value="{.}" placeholder="{@ph}" type="text" name="{name()}"
                                                           required=""/>
                                                    <p class="invalidFieldText">
                                                        <xsl:value-of select="//formData/exceptionMessage"/>
                                                    </p>
                                                </xsl:otherwise>
                                            </xsl:choose>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <xsl:choose>
                                                <xsl:when test="name() = 'price'">
                                                    <input value="{.}" placeholder="{@ph}" name="{name()}" type="number" min="0.05" step="0.05" required=""/>
                                                </xsl:when>
                                                <xsl:otherwise>
                                                    <input value="{.}" placeholder="{@ph}" name="{name()}" type="text" required=""/>
                                                </xsl:otherwise>
                                            </xsl:choose>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:for-each>
                            </xsl:when>
                            <xsl:otherwise>
                                <xsl:for-each select="//formData/fields/*">
                                    <xsl:choose>
                                        <xsl:when test="name() = 'price'">
                                            <input placeholder="{@ph}" name="{name()}" type="number" required=""/>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <input placeholder="{@ph}" name="{name()}" type="text" required=""/>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:for-each>
                            </xsl:otherwise>
                        </xsl:choose>
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
