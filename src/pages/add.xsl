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
                        <img class="library_logo" src="/css/library_logo.png" alt="Library Logo"/>
                        <h1 class="library_title">Library</h1>
                    </a>
                </header>
                <div class="add_book_form_container">
                    <h2>Add Book</h2>
                    <form class="add_book_form" action="/validate" method="post">
                        <!-- TODO: Aufräumen -->
                        <xsl:for-each select="//formData/fields/*">
                            <xsl:choose>
                                <xsl:when test="@invalidField = 'true'">
                                    <xsl:choose>
                                        <xsl:when test="name() = 'price'">
                                            <input class="invalidField" value="{.}" placeholder="{@ph}" name="{name()}"
                                                   type="number" step="0.05" min="0.05" required=""/>
                                            <p class="invalidFieldText">
                                                Invalid Field:
                                                <xsl:value-of select="name()"/>
                                            </p>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <input class="invalidField" value="{.}" placeholder="{@ph}" name="{name()}"
                                                   type="text" required=""/>
                                            <p class="invalidFieldText">
                                                Invalid Field:
                                                <xsl:value-of select="name()"/>
                                            </p>
                                        </xsl:otherwise>
                                    </xsl:choose>

                                </xsl:when>
                                <xsl:otherwise>
                                    <xsl:choose>
                                        <xsl:when test="name() = 'price'">
                                            <input value="{.}" placeholder="{@ph}" name="{name()}" type="number"
                                                   step="0.05" min="0.05"
                                                   required="">
                                            </input>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <input value="{.}" placeholder="{@ph}" name="{name()}" type="text"
                                                   required="">
                                            </input>
                                        </xsl:otherwise>
                                    </xsl:choose>
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
